<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/services/classes/Db.class.php';
    class Event extends Db{

        public function getEvents($user_id){
            $sql = "SELECT e.name, e.date, wt.name AS workout_type_name, e.event_id, e.done 
                    FROM `events` e 
                    JOIN workout w ON w.id = e.workout_id 
                    JOIN workout_type wt ON wt.id = w.workout_type 
                    WHERE e.user_id = ? AND e.date >= NOW() ";
            return $this->execute($sql, [$user_id]);
        }

        public function insertEvents($start_date, $end_date, $workout_id, $user_id, $name ){
            $given_end_date = $end_date;
            $given_start_date = $start_date;
            $date = new DateTime($given_start_date);
            $end_date = new \DateTime($given_end_date);
            while($date < $end_date) {
                $sql = "INSERT INTO events(name, done, date, `user_id`, `workout_id`) VALUES (?, ?, ?, ?, ?)";
                $date_string = $date->format('Y-m-d H:i:s');
                $this->execute($sql, [$name, 0, $date_string, $user_id, $workout_id]);
                $date = $date->modify('+2 day');
            }

        }

        public function setDone($event_id, $done){
            $sql = "UPDATE `events` SET `done` = ? WHERE `event_id` = ?";
            return $this->execute($sql, [$done, $event_id]);
        }

        public function getNextEvent($user_id)
        {
            $sql = "SELECT e.name, e.date, wt.name AS workout_type_name, e.event_id, e.done 
                    FROM `events` e 
                    JOIN workout w ON w.id = e.workout_id 
                    JOIN workout_type wt ON wt.id = w.workout_type 
                    WHERE e.user_id = ? AND e.date >= NOW() AND e.done != 1 LIMIT 1;";
            return $this->execute($sql, [$user_id]);

        }
    }
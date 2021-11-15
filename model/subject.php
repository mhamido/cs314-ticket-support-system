 <?php
  interface Subject
    {
          // Attach an observer to the subject.
          public function register( $observer);
 
          // Detach an observer from the subject.
          public function remove($observer);
 
          // Notify all observers about an event.
          public function notify();
 }
 ?>
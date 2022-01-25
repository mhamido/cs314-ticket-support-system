<?php
    class Context 
    {
        private $state;

        public function __construct(State $state)
        {
            $this->transitionTo($state);
        }
     
        public function transitionTo($state)
        {
            echo "Context: Transition to " . get_class($state) . ".\n";
            $this->state = $state;
            $this->state->setContext($this);	
        }
     
        public function request1()
        {
            $this->state->doAction();
        }
    }
    class StatePatternDemo 
    {
        public static function main() 
        {
           $context = new Context();
     
           $startState = new StartState();
           $startState->doAction($context);
     
           //System.out.println(context.getState().toString());
     
           $stopState = new StopState();
           $stopState->doAction($context);
     
           System.out.println(context.getState().toString());
        }
     }
?>
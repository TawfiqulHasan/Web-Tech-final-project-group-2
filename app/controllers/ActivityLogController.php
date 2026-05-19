<?php
class ActivityLogController {
    public function index() {
        require_role(["admin", "manager"]);

        view("activity_logs/index", ["logs" => ActivityLog::all()]);
    }
}
?>

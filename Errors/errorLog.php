<?php
if(isset($result)) {
    if(!($result->{"Result"})) {
        echo '<div class="alert alert-danger" style="display: flex;flex-direction: column;justify-content: center;min-width: 400px;margin: 2rem;padding: 2rem;">';
        echo '<p style="direction: ltr;">Error Code: ' . $result->ErrorCode . '</p>';
        echo '<p style="direction: ltr;">Error Message: ' . $result->ErrorMessage . '</p>';
        echo '</div>';
    }
}
?>
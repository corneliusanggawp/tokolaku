<?php

class SweetAlert {
    public static function setSweetAlert($title, $text, $icon)
    {
        $_SESSION['sweetAlert'] = [
            'title' => $title,
            'text'  => $text,
            'icon'  => $icon
        ];
    }

    public static function sweetAlert()
    {
        if(isset($_SESSION['sweetAlert'])) {
            echo "
                <script>
                    if(true)
                    {
                        Swal.fire({
                            title: '". $_SESSION['sweetAlert']['title'] ."',
                            text: '". $_SESSION['sweetAlert']['text'] ."',
                            icon: '". $_SESSION['sweetAlert']['icon'] ."'
                        })
                    }
                </script>
            ";
            unset($_SESSION['sweetAlert']);
        }
    }

    public static function setSweetToast($position, $duration, $icon, $title)
    {
        $_SESSION['sweetToast'] = [
            'position' => $position,
            'duration' => $duration,
            'icon' => $icon,
            'title' => $title
        ];
    }

    public static function sweetToast()
    {
        if (isset($_SESSION['sweetToast'])) {
            echo"
                <script>
                    if(true){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: '" . $_SESSION['sweetToast']['position'] . "',
                            showConfirmButton: false,
                            timer:  '" . $_SESSION['sweetToast']['duration'] . "',
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon:  '" . $_SESSION['sweetToast']['icon'] . "',
                            title:  '" . $_SESSION['sweetToast']['title'] . "'
                        })
                    }
                </script>
            ";
            unset($_SESSION['sweetToast']);
        }
    }
}
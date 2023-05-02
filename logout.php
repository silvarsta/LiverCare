<?php
	session_start();
	// Hapus session
	session_destroy();
	// Redirect ke halaman landing
	header("Location: landing.php");

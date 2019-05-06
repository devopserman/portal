<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include ("auth.php");
include ("start.php");
include ("core/core.php");
echo '<!DOCTYPE html>
<HTML>
    <HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<link href="/css/style.css" rel="stylesheet" type="text/css" />
		
				
			<!-- Load jQuery  -->
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

			<!-- Load WysiBB JS and Theme -->
			<script src="/js/jquery.wysibb.min.js"></script>
			<link rel="stylesheet" href="/css/wbbtheme.css" />
			
			<script>
				$(function() {
				  $("#editor").wysibb();
				})
			</script>
			
<!-- 			<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
			<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
			<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
			<script src="/js/search.js"></script>
			<script src="/js/f5.js"></script>  -->
			

			
    </HEAD>
<BODY> 

					<table border="'.VAR_BORDER.'" style="border-collapse: collapse; width: '.VAR_MAX_WIDTH.'; margin: auto;">
						<tbody>
							<tr>
								<td style="width: 100%;">
									<table border="'.VAR_BORDER.'" style="border-collapse: collapse; width: 100%;">
											<tbody>
											<tr>
											<td style="width: '.VAR_LEFT_COL_WIDTH.'; " align="right"></td>
												<td style="width: '.VAR_CENTER_COL_WIDTH.';">
													';
													#header
													
													@include('header.php');
												echo '</td>
												<td style="width: '.VAR_RIGHT_COL_WIDTH.';">
												</td>
											</tr>
										</tbody>
									</table>
									<table border="'.VAR_BORDER.'" style="border-collapse: collapse; width: 100%;">
										<tbody>
											<tr>
												<td valign="top" style="width: '.VAR_LEFT_COL_WIDTH.';">
												';
													 #left
												echo '
												</td>
												<td valign="top" style="width: '.VAR_CENTER_COL_WIDTH.';">
												';
													 #center
													 
													 include('content.php');
												echo '
												</td>
												<td valign="top" style="width: '.VAR_RIGHT_COL_WIDTH.'; padding-top:35px;">
												';
													 include('right_col.php');
													 
												echo '
												</td>
											</tr>
										</tbody>
									</table>
									
									
									
									
									
									<table border="'.VAR_BORDER.'" style="border-collapse: collapse; width: 100%;">
										<tbody>
											<tr>
												<td style="width: 100%;">
													 ';
													 #footer
												echo '
												</td>
											</tr>
										</tbody>
									</table>
									
									
									
								</td>
							</tr>
						</tbody>
					</table>
				


';
	
	
	
	
	
echo '</BODY></html>';
?>
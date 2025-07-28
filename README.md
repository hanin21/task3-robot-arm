# Robot Arm Control Panel

This project is a simple web-based interface to control a robotic arm using sliders. It allows the user to save, load, remove, and run motor positions.

# Technologies Used
- HTML, CSS, JavaScript
- PHP
- MySQL (via XAMPP)

# Features
- Control 6 motors using sliders
- Save current pose to the database
- Load and apply saved poses
- Delete saved poses
- Run the latest saved pose

# Main Files
| File | Function | 
| `index.php` | Main control page |
| `save_pose.php` | Save pose to database |
| `get_poses.php` | Get saved poses |
| `remove_pose.php` | Delete a pose |
| `get_run_pose.php` | Get the latest pose |
| `update_status.php` | Reset status (value = 0) |

---

# Database

### Database name: `robot_arm`

#### Table: `poses`
| Column  | Type |
| id | INT (Primary Key) |
| motor1 - motor6 | INT |
| date | TIMESTAMP |

#### Table: `status`
| Column | Type |
| id     | INT |
| value  | INT |

# How to Use
1. Run Apache & MySQL in XAMPP  
2. Create `robot_arm` database and the tables above  
3. Place all files in `htdocs/robot-arm`  
4. Open in browser:  http://localhost/robot-arm/index.php

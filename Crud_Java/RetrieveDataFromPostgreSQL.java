import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;

public class RetrieveDataFromPostgreSQL {

    private static final String JDBC_URL = "jdbc:postgresql://localhost:5432/naresh";
    private static final String USERNAME = "datab";
    private static final String PASSWORD = "datab";

    private static final Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        try {
            Class.forName("org.postgresql.Driver");

            while (true) {
                System.out.println("1. Insert");
                System.out.println("2. Update");
                System.out.println("3. Delete");
                System.out.println("4. Display All Records");
                System.out.println("5. Exit");
                System.out.print("Enter your choice: ");

                int choice = scanner.nextInt();

                switch (choice) {
                    case 1:
                        insertData();
                        break;
                    case 2:
                        updateData();
                        break;
                    case 3:
                        deleteData();
                        break;
                    case 4:
                        displayAllData();
                        break;
                    case 5:
                        System.out.println("Exiting the program.");
                        System.exit(0);
                    default:
                        System.out.println("Invalid choice. Please enter a valid option.");
                }
            }
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }
    }

    private static void insertData() {
        try (Connection connection = DriverManager.getConnection(JDBC_URL, USERNAME, PASSWORD)) {
            System.out.print("Enter roll_no: ");
            int rollNo = scanner.nextInt();

            System.out.print("Enter Student_Name: ");
            String studentName = scanner.next();

            System.out.print("Enter Gender: ");
            String gender = scanner.next();

            System.out.print("Enter sslc_mark: ");
            int sslcMark = scanner.nextInt();

            System.out.print("Enter hsc_mark: ");
            int hscMark = scanner.nextInt();

            String insertQuery = "INSERT INTO student(roll_no, Student_Name, Gender, sslc_mark, hsc_mark) VALUES (?, ?, ?, ?, ?)";
            try (PreparedStatement preparedStatement = connection.prepareStatement(insertQuery)) {
                preparedStatement.setInt(1, rollNo);
                preparedStatement.setString(2, studentName);
                preparedStatement.setString(3, gender);
                preparedStatement.setInt(4, sslcMark);
                preparedStatement.setInt(5, hscMark);

                int rowsAffected = preparedStatement.executeUpdate();
                if (rowsAffected > 0) {
                    System.out.println("Data inserted successfully!");
                } else {
                    System.out.println("Failed to insert data.");
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private static void updateData() {
        try (Connection connection = DriverManager.getConnection(JDBC_URL, USERNAME, PASSWORD)) {
            System.out.println("List of all values in the 'student' table:");
            displayAllData();

            System.out.print("Enter the roll_no to update: ");
            int rollNo = scanner.nextInt();

            System.out.println("Select the column to update:");
            System.out.println("1. Student_Name");
            System.out.println("2. Gender");
            System.out.println("3. sslc_mark");
            System.out.println("4. hsc_mark");
            System.out.print("Enter your choice: ");
            int columnChoice = scanner.nextInt();

            String column;
            switch (columnChoice) {
                case 1:
                    column = "Student_Name";
                    break;
                case 2:
                    column = "Gender";
                    break;
                case 3:
                    column = "sslc_mark";
                    break;
                case 4:
                    column = "hsc_mark";
                    break;
                default:
                    System.out.println("Invalid choice. Aborting update.");
                    return;
            }

            System.out.print("Enter the new value: ");
            String newValue = scanner.next();

            String updateQuery = "UPDATE student SET " + column + " = ? WHERE roll_no = ?";
            try (PreparedStatement preparedStatement = connection.prepareStatement(updateQuery)) {
                preparedStatement.setString(1, newValue);
                preparedStatement.setInt(2, rollNo);

                int rowsAffected = preparedStatement.executeUpdate();
                if (rowsAffected > 0) {
                    System.out.println("Data updated successfully!");
                } else {
                    System.out.println("Failed to update data. Please check the roll_no and column name.");
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private static void deleteData() {
        try (Connection connection = DriverManager.getConnection(JDBC_URL, USERNAME, PASSWORD)) {
            System.out.print("Enter the roll_no to delete: ");
            int rollNo = scanner.nextInt();

            String deleteQuery = "DELETE FROM student WHERE roll_no = ?";
            try (PreparedStatement preparedStatement = connection.prepareStatement(deleteQuery)) {
                preparedStatement.setInt(1, rollNo);

                int rowsAffected = preparedStatement.executeUpdate();
                if (rowsAffected > 0) {
                    System.out.println("Data deleted successfully!");
                } else {
                    System.out.println("No data found for the given roll_no.");
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private static void displayAllData() {
        try (Connection connection = DriverManager.getConnection(JDBC_URL, USERNAME, PASSWORD)) {
            String selectQuery = "SELECT * FROM student";
            try (PreparedStatement preparedStatement = connection.prepareStatement(selectQuery);
                 ResultSet resultSet = preparedStatement.executeQuery()) {

                while (resultSet.next()) {
                    System.out.println("Roll No: " + resultSet.getInt("roll_no"));
                    System.out.println("Student Name: " + resultSet.getString("Student_Name"));
                    System.out.println("Gender: " + resultSet.getString("Gender"));
                    System.out.println("SSLC Mark: " + resultSet.getInt("sslc_mark"));
                    System.out.println("HSC Mark: " + resultSet.getInt("hsc_mark"));
                    System.out.println("--------------");
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}

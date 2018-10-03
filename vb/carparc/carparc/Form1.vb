Public Class Form1
    Dim duration1 = 0
    Dim duration2 = 0
    Dim duration3 = 0

    Dim active1 = 0
    Dim active2 = 0
    Dim active3 = 0

    Dim active1mark = 0
    Dim active2mark = 0
    Dim active3mark = 0

    Dim data As Integer


    Private Sub Button3_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button3.Click
        data = data + 100
        Label13.Text = data
      
      

    End Sub

  

    Private Sub Timer1_Tick(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Timer1.Tick
        Try

            Dim data As Integer = SerialPort1.ReadLine()

            Label13.Text = data

        Catch ex As Exception

        End Try

        Label26.Text = TextBox3.Text * 60

        Label29.Text = TextBox4.Text * 60

        
        Label6.Text = TimeOfDay
        Label17.Text = DateAdd(DateInterval.Hour, 2, TimeOfDay)

        ' Label17.Text = TimeOfDay.AddHours(2) ' // pseudo code 2am

        Dim data1 = Convert.ToDateTime(Label6.Text)
        Dim data2 = Convert.ToDateTime(Label17.Text)




        Label6.Text = data1
        Label17.Text = data2


        Dim hourtoday = TimeOfDay.Hour
        Dim mintoday = TimeOfDay.Minute

        'Label17.Text = data1
        Dim timer1var As Integer
        Dim timer2var As Integer
        Dim timer3var As Integer
        Dim refgraceperiod As Integer
        Dim refparkperiod As Integer

            refgraceperiod = Label26.Text
        refparkperiod = Label29.Text


        Dim graceperiod1 = 0
        Dim parkperiod1 = 0

        Dim graceperiod2 = 0
        Dim parkperiod2 = 0

        Dim graceperiod3 = 0
        Dim parkperiod3 = 0



        timer1var = Label2.Text



        If timer1var >= refgraceperiod And Label10.Text = "Active" Then
            graceperiod1 = 0
            parkperiod1 = 1
            datasending()

        ElseIf timer1var < refgraceperiod And timer1var > 0 And Label10.Text = "Active" Then
            graceperiod1 = 1
            parkperiod1 = 0
            datasending()

        End If





        timer2var = Label3.Text
        If timer2var >= refgraceperiod And Label11.Text = "Active" Then
            graceperiod2 = 0
            parkperiod2 = 1
            datasending()

        ElseIf timer2var < refgraceperiod And timer2var > 0 And Label11.Text = "Active" Then
            graceperiod2 = 1
            parkperiod2 = 0
            datasending()

        End If

        timer3var = Label4.Text
        If timer3var >= refgraceperiod And Label12.Text = "Active" Then
            graceperiod3 = 0
            parkperiod3 = 1
            datasending()

        ElseIf timer3var < refgraceperiod And timer3var > 0 And Label12.Text = "Active" Then
            graceperiod3 = 1
            parkperiod3 = 0
            datasending()

        End If


        Label22.Text = parkperiod1
        Label23.Text = parkperiod2
        Label24.Text = parkperiod3

        Label32.Text = graceperiod1
        Label31.Text = graceperiod2
        Label30.Text = graceperiod3



        If hourtoday < 18 And hourtoday > 6 Then
            Label7.Text = "Paid Parking"
        Else
            Label7.Text = "Free Parking"
        End If
        Try

        Dim data As Integer = SerialPort1.ReadLine()

            Label13.Text = data
        Catch ex As Exception

        End Try


        '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        'active inactive trigger
        If Label13.Text = 0 Then
            Label10.Text = "Inactive"
            Label11.Text = "Inactive"
            Label12.Text = "Inactive"

            active1 = 0
            active2 = 0
            active3 = 0

            If active3mark = 1 And active3 = 0 Then
                active3mark = 0
                Label35.Text = data1

            End If
            If active2mark = 1 And active2 = 0 Then
                active2mark = 0
                Label36.Text = data1
            End If
            If active1mark = 1 And active1 = 0 Then
                active1mark = 0
                Label37.Text = data1
            End If



            active1mark = 0
            active2mark = 0
            active3mark = 0

            If active1 = 0 Then
                ' Label14.Text = 0

            End If

            If active2 = 0 Then
                '                    Label15.Text = 0

            End If
            If active3 = 0 Then
                '                   Label16.Text = 0

            End If
        End If

        If Label13.Text = 1 Then
            Label10.Text = "Inactive"
            Label11.Text = "Inactive"
            Label12.Text = "Active"
            active1 = 0
            active2 = 0
            active3 = 1

            If active1 = 0 Then
                '                  Label14.Text = 0

            End If

            If active2 = 0 Then
                '                 Label15.Text = 0

            End If
            If active3 = 0 Then
                '                Label16.Text = 0

            End If

            If active3mark = 1 And active3 = 0 Then
                active3mark = 0
                Label35.Text = data1

            End If
            If active2mark = 1 And active2 = 0 Then
                active2mark = 0
                Label36.Text = data1
            End If
            If active1mark = 1 And active1 = 0 Then
                active1mark = 0
                Label37.Text = data1
            End If



            If active3mark = 0 And active3 = 1 Then
                active3mark = 1
                Label16.Text = data1

            End If
            If active2mark = 0 And active2 = 1 Then
                active2mark = 1
                Label15.Text = data1
            End If
            If active1mark = 0 And active1 = 1 Then
                active1mark = 1
                Label14.Text = data1
            End If


        End If
        If Label13.Text = 10 Then
            Label10.Text = "Inactive"
            Label11.Text = "Active"
            Label12.Text = "Inactive"

            active1 = 0
            active2 = 1
            active3 = 0

            If active1 = 0 Then
                '     Label14.Text = 0

            End If

            If active2 = 0 Then
                '    Label15.Text = 0

            End If
            If active3 = 0 Then
                '   Label16.Text = 0

            End If

            If active3mark = 1 And active3 = 0 Then
                active3mark = 0
                Label35.Text = data1

            End If
            If active2mark = 1 And active2 = 0 Then
                active2mark = 0
                Label36.Text = data1
            End If
            If active1mark = 1 And active1 = 0 Then
                active1mark = 0
                Label37.Text = data1
            End If

            If active3mark = 0 And active3 = 1 Then
                active3mark = 1
                Label16.Text = data1
            End If
            If active2mark = 0 And active2 = 1 Then
                active2mark = 1
                Label15.Text = data1
            End If
            If active1mark = 0 And active1 = 1 Then
                active1mark = 1
                Label14.Text = data1
            End If

        End If
        If Label13.Text = 100 Then
            Label10.Text = "Active"
            Label11.Text = "Inactive"
            Label12.Text = "Inactive"

            active1 = 1
            active2 = 0
            active3 = 0
            If active3mark = 1 And active3 = 0 Then
                active3mark = 0
                Label35.Text = data1

            End If
            If active2mark = 1 And active2 = 0 Then
                active2mark = 0
                Label36.Text = data1
            End If
            If active1mark = 1 And active1 = 0 Then
                active1mark = 0
                Label37.Text = data1
            End If

            If active3mark = 0 And active3 = 1 Then
                active3mark = 1
                Label16.Text = data1
            End If
            If active2mark = 0 And active2 = 1 Then
                active2mark = 1
                Label15.Text = data1
            End If
            If active1mark = 0 And active1 = 1 Then
                active1mark = 1
                Label14.Text = data1
            End If

        End If
        If Label13.Text = 11 Then
            Label10.Text = "Inactive"
            Label11.Text = "Active"
            Label12.Text = "Active"

            active1 = 0
            active2 = 1
            active3 = 1
            If active1 = 0 Then
                '  Label14.Text = 0

            End If

            If active2 = 0 Then
                ' Label15.Text = 0

            End If
            If active3 = 0 Then
                'Label16.Text = 0

            End If
            If active3mark = 1 And active3 = 0 Then
                active3mark = 0
                Label35.Text = data1

            End If
            If active2mark = 1 And active2 = 0 Then
                active2mark = 0
                Label36.Text = data1
            End If
            If active1mark = 1 And active1 = 0 Then
                active1mark = 0
                Label37.Text = data1
            End If

            If active3mark = 0 And active3 = 1 Then
                active3mark = 1
                Label16.Text = data1
            End If
            If active2mark = 0 And active2 = 1 Then
                active2mark = 1
                Label15.Text = data1
            End If
            If active1mark = 0 And active1 = 1 Then
                active1mark = 1
                Label14.Text = data1
            End If


        End If
        If Label13.Text = 101 Then
            Label10.Text = "Active"
            Label11.Text = "Inactive"
            Label12.Text = "Active"


            active1 = 1
            active2 = 0
            active3 = 1

            If active1 = 0 Then
                '  Label14.Text = 0

            End If

            If active2 = 0 Then
                ' Label15.Text = 0

            End If
            If active3 = 0 Then
                'Label16.Text = 0

            End If
            If active3mark = 1 And active3 = 0 Then
                active3mark = 0
                Label35.Text = data1

            End If
            If active2mark = 1 And active2 = 0 Then
                active2mark = 0
                Label36.Text = data1
            End If
            If active1mark = 1 And active1 = 0 Then
                active1mark = 0
                Label37.Text = data1
            End If

            If active3mark = 0 And active3 = 1 Then
                active3mark = 1
                Label16.Text = data1
            End If
            If active2mark = 0 And active2 = 1 Then
                active2mark = 1
                Label15.Text = data1
            End If
            If active1mark = 0 And active1 = 1 Then
                active1mark = 1
                Label14.Text = data1
            End If

        End If
        If Label13.Text = 110 Then
            Label10.Text = "Active"
            Label11.Text = "Active"
            Label12.Text = "Inactive"

            active1 = 1
            active2 = 1
            active3 = 0
            If active1 = 0 Then
                Label14.Text = 0

            End If

            If active2 = 0 Then
                Label15.Text = 0

            End If
            If active3 = 0 Then
                Label16.Text = 0

            End If
            If active3mark = 1 And active3 = 0 Then
                active3mark = 0
                Label35.Text = data1

            End If
            If active2mark = 1 And active2 = 0 Then
                active2mark = 0
                Label36.Text = data1
            End If
            If active1mark = 1 And active1 = 0 Then
                active1mark = 0
                Label37.Text = data1
            End If

            If active3mark = 0 And active3 = 1 Then
                active3mark = 1
                Label16.Text = data1
            End If
            If active2mark = 0 And active2 = 1 Then
                active2mark = 1
                Label15.Text = data1
            End If
            If active1mark = 0 And active1 = 1 Then
                active1mark = 1
                Label14.Text = data1
            End If


        End If
        If Label13.Text = 111 Then
            Label10.Text = "Active"
            Label11.Text = "Active"
            Label12.Text = "Active"


            active1 = 1
            active2 = 1
            active3 = 1
            If active3mark = 1 And active3 = 0 Then
                active3mark = 0
                Label35.Text = data1

            End If
            If active2mark = 1 And active2 = 0 Then
                active2mark = 0
                Label36.Text = data1
            End If
            If active1mark = 1 And active1 = 0 Then
                active1mark = 0
                Label37.Text = data1
            End If

            If active3mark = 0 And active3 = 1 Then
                active3mark = 1
                Label16.Text = data1
            End If
            If active2mark = 0 And active2 = 1 Then
                active2mark = 1
                Label15.Text = data1
            End If
            If active1mark = 0 And active1 = 1 Then
                active1mark = 1
                Label14.Text = data1
            End If


        End If




        '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''



        '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        '''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        datasending()



        If active1 = 1 Then
            duration1 = duration1 + 1
            Label2.Text = duration1

        Else
            duration1 = 0
            '   Label2.Text = duration1
            graceperiod1 = 0
            parkperiod1 = 0



            Label22.Text = parkperiod1
            Label23.Text = parkperiod2
            Label24.Text = parkperiod3

            Label32.Text = graceperiod1
            Label31.Text = graceperiod2
            Label30.Text = graceperiod3

        End If

        If active2 = 1 Then

            duration2 = duration2 + 1
            Label3.Text = duration2


        Else


            duration2 = 0
            '  Label3.Text = duration2
            graceperiod2 = 0
            parkperiod2 = 0


            Label22.Text = parkperiod1
            Label23.Text = parkperiod2
            Label24.Text = parkperiod3

            Label32.Text = graceperiod1
            Label31.Text = graceperiod2
            Label30.Text = graceperiod3

        End If
        If active3 = 1 Then

            duration3 = duration3 + 1
            Label4.Text = duration3
        Else
            duration3 = 0
            ' Label4.Text = duration3
            graceperiod3 = 0
            parkperiod3 = 0



            Label22.Text = parkperiod1
            Label23.Text = parkperiod2
            Label24.Text = parkperiod3

            Label32.Text = graceperiod1
            Label31.Text = graceperiod2
            Label30.Text = graceperiod3

        End If





    End Sub
    Private Sub Button8_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button8.Click
        data = data - 100
        Label13.Text = data


    End Sub

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click


        If Button1.Text = "Open" Then


            Try
                SerialPort1.PortName = ComboBox1.Text
                SerialPort1.Open()
                Label8.Text = "Connected"
                Button1.Text = "Close"

            Catch ex As Exception
                MsgBox("CANNOT OPEN PORT , PLEASE SELECT THE PROPER PORT")


            End Try


        ElseIf Button1.Text = "Close" Then


            Try

                SerialPort1.Close()
                Button1.Text = "Open"
                Label8.Text = "Disconnected"

            Catch ex As Exception
                MsgBox("PORT already closed")


            End Try
        End If
    End Sub

    Private Sub Form1_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
5:
        Label8.Text = ""
        TextBox1.Text = My.Settings.address
        TextBox3.Text = My.Settings.grace





    End Sub

    Private Sub Button5_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button5.Click
        data = data + 10
        Label13.Text = data

    End Sub

    Private Sub Button6_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button6.Click
        data = data + 1
        Label13.Text = data

    End Sub

    Private Sub Button7_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button7.Click
        data = data - 10
        Label13.Text = data

    End Sub

    Private Sub Button4_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button4.Click
        data = data - 1
        Label13.Text = data

    End Sub

    Private Sub Button2_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button2.Click
        My.Settings.address = TextBox1.Text
        My.Settings.Save()

        Dim startTime As New DateTime(2013, 9, 19, 10, 30, 0)     ' 10:30 AM today
        Dim endTime As New DateTime(2013, 9, 20, 2, 0, 0)     ' 2:00 AM tomorrow
        Dim duration As TimeSpan = endTime - startTime        'Subtract start time from end time


    End Sub

    Private Sub Button9_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button9.Click
        datasending()
    End Sub
    Public Sub datasending()
        TextBox2.Text = TextBox1.Text + "?a=" + Label10.Text + "&b=" + Label11.Text + "&c=" + Label12.Text + "&d=" + Label14.Text + "&e=" + Label15.Text + "&f=" + Label16.Text + "&g=" + Label37.Text + "&h=" + Label36.Text + "&i=" + Label35.Text + "&j=" + Label22.Text + "&k=" + Label23.Text + "&l=" + Label24.Text + "&m=" + Label32.Text + "&n=" + Label31.Text + "&o=" + Label30.Text + "&p=" + Label2.Text + "&q=" + Label3.Text + "&r=" + Label4.Text
        WebBrowser1.Navigate(TextBox2.Text)

    End Sub



    Private Sub Button10_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button10.Click
        My.Settings.grace = TextBox3.Text
        My.Settings.Save()


    End Sub


  

    Private Sub TextBox2_TextChanged(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles TextBox2.TextChanged

    End Sub
End Class

CREATE TABLE [dbo].[uzytkownicy](
	[ID_uzytkownika] [int] IDENTITY(1,1) NOT FOR REPLICATION NOT NULL,
	[Uzytkownik] [nchar](20) NOT NULL,
	[Haslo] [text] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
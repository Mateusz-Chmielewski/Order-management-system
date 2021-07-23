ALTER TABLE [dbo].[zlecenia]  WITH CHECK ADD  CONSTRAINT [FK_zlecenia_statusy] FOREIGN KEY([Status])
REFERENCES [dbo].[statusy] ([ID_status])
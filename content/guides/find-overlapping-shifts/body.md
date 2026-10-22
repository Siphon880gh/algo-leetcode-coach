A table lists employees’ shifts with start and end times. For each employee, count how many pairs of their shifts overlap, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Ordered pairs

This assumes two shifts overlap when one starts before the other and ends after the other starts, and that each pair counts once; check the official statement, including whether employees with no overlaps appear.

Using the column names the statement gives:

1. `SELECT a.emp, COUNT(*) FROM shifts a JOIN shifts b ON a.emp = b.emp AND a.st < b.st AND a.en > b.st GROUP BY a.emp ORDER BY a.emp`

Constructed check (run in SQLite): employee 1 works 08–12, 11–15, 14–18; employee 2 works 09–17, 16–20; employee 3 works 10–12, 12–14 → (1, 2), (2, 1).

Joining on a.st <> b.st counts pairs from both sides: (1, 5), (2, 2), (3, 1). Using ≥ for the end test counts back-to-back shifts: employee 3 gets 1.

Time: O(k²) per employee with k shifts  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.

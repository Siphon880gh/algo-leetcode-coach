## Consistency filtering

`match(a, b)` = the number of positions where the 6-letter words agree.

Loop until solved or out of guesses:

1. Pick a guess `g` from the candidates.
2. `m = master.guess(g)`. If `m == 6`, stop.
3. Keep only candidates `c` with `match(c, g) == m`.

**Choosing g (minimax):** for each candidate, group the other candidates by their match count with it, and take the size of the largest group. Guess the candidate whose largest group is smallest. This shrinks the pool quickly in the worst case.

A random guess plus filtering also usually passes, but the minimax choice makes it reliable against adversarial word lists. A common cheap heuristic is to guess the word with the **fewest** 0-match partners: a 0-match answer is the most likely one, so you want it to leave as few candidates as possible.

Do not guess words that are inconsistent with earlier answers. Do not filter only on `m > 0`; the exact count matters.

Time: O(guesses · n²)  
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

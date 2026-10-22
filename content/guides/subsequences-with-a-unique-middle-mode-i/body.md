## Count per middle

For middle i with value v: a copies of v among the i elements on the left, b among the R = n − 1 − i on the right. Pick 2 from each side, x and y of them equal to v.

1. x + y ≥ 2: add C(a, x) · C(i − a, 2 − x) · C(b, y) · C(R − b, 2 − y).
2. x = 1, y = 0: the left non-v pick (value u) and the two right non-v picks must all differ. With S = right non-v count and Q = Σ r_w² over non-v values, the right pairs of two different values avoiding u number (S² − Q) / 2 − r_u (S − r_u). Add a · Σ_u l_u · that. Mirror for x = 0, y = 1.
3. x + y = 0: nothing.

Examples → 6, 4, 0. Checked against every 5-subsequence on 300 random arrays. Take everything mod 10^9 + 7 (use the inverse of 2 for the halving).

Skipping the exactly-twice case: example 2 → 0 instead of 4.

Time: O(n · D), D = distinct values, at most 10^6  
Space: O(D)

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

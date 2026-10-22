## Complement

With A = no l, B = no t, C = at most one e:

1. |A| = |B| = 25^n, |C| = 25^n + n·25^(n−1).
2. |A∩B| = 24^n, |A∩C| = |B∩C| = 24^n + n·24^(n−1), |A∩B∩C| = 23^n + n·23^(n−1).
3. Return `26^n − (|A| + |B| + |C|) + (pairs) − |A∩B∩C|` mod 10^9 + 7.

Examples → 12, 83943898. Checked against a weighted count of every string for n ≤ 8.

Time: O(log n)  
Space: O(1)

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

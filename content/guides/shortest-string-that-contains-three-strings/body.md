## Merge in every order

1. `merge(s, t)`: if t is inside s, return s; otherwise append t after the longest suffix of s that is a prefix of t.
2. For each of the 6 orders (x, y, z): `merge(merge(x, y), z)`.
3. Return the shortest, then lexicographically smallest.

Examples → aaabca, aba. Checked against the shortest, smallest string over a and b found by search on 300 random small inputs.

Without the containment check, a = abc, b = b, c = c → abcb instead of abc.

Time: O(6 · L²) with L ≤ 300  
Space: O(L)

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

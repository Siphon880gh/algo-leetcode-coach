## Range updates in O(1)

1. `d[start] += v`, `d[end + 1] −= v`, with `v = 1` forward and `v = −1` backward.
2. Running sum `c`; position `i` becomes `(s[i] − a + c) mod 26`.

Examples → ace, catz.

Applying each shift directly costs up to 5 · 10^4 · 5 · 10^4 = 2.5 · 10^9 steps. Take the modulo so negative totals wrap: in Python `%` already does, in C-like languages add 26 after `% 26`.

Time: O(n + q)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.

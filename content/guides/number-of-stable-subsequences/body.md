## Four counters

1. f[p][1], f[p][2] = 0.
2. For x with parity p (q = 1 − p): new1 = f[q][1] + f[q][2] + 1; new2 = f[p][1] (before updating); f[p][1] += new1; f[p][2] += new2.
3. Return the sum of all four, mod 10^9 + 7.

Examples → 6, 14. Checked against listing every subsequence on 1,500 random arrays.

Allowing no two equal parities in a row: example 2 → 9 instead of 14.

Time: O(n)  
Space: O(1)

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

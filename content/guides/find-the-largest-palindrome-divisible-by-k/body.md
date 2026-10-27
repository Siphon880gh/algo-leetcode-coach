## Feasible remainders

1. Pair i adds d · (10^i + 10^(n − 1 − i)) mod k (the middle digit once).
2. feas[i][r]: pairs i … can bring remainder r to 0. Fill from the inside out.
3. From the outside, pick the largest digit d (no leading 0) with feas[i + 1][r + d · w] true.

Examples → 595, 8, 89898. Checked against brute force for n ≤ 6 and every k.

Stepping down from 99…9 through palindromes is hopeless: for k = 5 the answer must start with 5, so every palindrome starting with 9, 8, 7 or 6 would be tried first.

Time: O(n · k · 10)  
Space: O(n · k)

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

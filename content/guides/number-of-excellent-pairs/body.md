## Only popcounts matter

1. `cnt[p]` = number of distinct values with popcount `p`.
2. Return `Σ cnt[i] · cnt[j]` over `i, j` with `i + j ≥ k`.

Examples → 5, 0. Checked against every pair on 300 random arrays.

Each bit set in both numbers counts twice (in OR and AND), and each bit in one counts once, which is the sum of popcounts. Pairs are ordered and (x, x) counts, so both i and j range over everything. Popcounts are at most 30, so the double loop is tiny; the answer can reach 10^10, so use 64-bit.

Time: O(n + 31²)  
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

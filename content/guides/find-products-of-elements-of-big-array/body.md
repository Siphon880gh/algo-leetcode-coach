## Prefix exponent sums

1. For x, count the set bits of 1 … x per bit position b (and add b for each to the exponent sum).
2. F(N): binary-search the largest x whose total set bits ≤ N, then add the lowest remaining bits of x + 1.
3. Answer = 2^(F(to + 1) − F(from)) mod mod_i, by fast power.

Examples → [4], [2, 2]. F matches building big_nums directly for every N < 3000.

big_nums starts at index 0 (1, 2, 1, 2, 4, …). F(10^15 + 1) ≈ 2.2 · 10^16; use 64-bit.

Time: O(log² N) per query  
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

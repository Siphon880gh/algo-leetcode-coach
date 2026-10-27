## Good popcounts

1. steps(1) = 0, steps(c) = 1 + steps(popcount(c)); good c have steps(c) ≤ k − 1.
2. For each 1 bit of s at position i with j ones before it: setting it to 0 frees the rem lower bits; add C(rem, c − j) for each good c.
3. Answer the sum mod 10^9 + 7.

Examples → 3, 6, 0. Checked against direct counting for n ≤ 3000.

Counting n itself (≤ n): example 2 → 7 instead of 6.

Time: O(L²), L ≤ 800  
Space: O(L²) for the binomials

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

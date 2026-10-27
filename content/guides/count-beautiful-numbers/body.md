## Digit DP

1. f(x): walk the digits of x; skip leading zeros (not started); after the first nonzero digit, add d to the sum and multiply the product by d.
2. At the end, count 1 when started and product mod sum = 0.
3. Answer f(r) − f(l − 1).

Examples → 2, 10. Checked against direct counting on 50 random ranges up to 3,000; f(10⁹ − 1) runs in well under a second.

Treating leading zeros as digits: l = 10, r = 100 → 91 instead of 16.

Time: O(digits · 10 · reachable (sum, product) states)  
Space: the same

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

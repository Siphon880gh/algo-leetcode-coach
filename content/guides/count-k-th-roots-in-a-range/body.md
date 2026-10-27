## Roots

1. k = 1 → r − l + 1.
2. root(y) = largest x with x^k ≤ y (a float guess, then fix it up with integer powers).
3. low = 0 if l = 0, else root(l − 1) + 1. Return root(r) − low + 1.

0 = 0^k counts. Examples → 2, 3. Edge checks: l = 0, r = 10^9, k = 30 → 2; k = 1 over [0, 10^9] → 1,000,000,001. Checked against testing every y on 400 random ranges.

Trusting int(r ** (1 / k)): l = 1, r = 10^9, k = 3 → 999 instead of 1,000.

Time: O(log r)  
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

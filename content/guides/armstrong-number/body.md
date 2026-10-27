An integer with `k` digits is an Armstrong number when the sum of its digits, each raised to the `k`-th power, equals the number itself. Given `n`, return whether it is one. For instance, 153 is (1 + 125 + 27), and 123 is not (1 + 8 + 27 = 36). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Direct check

1. `k = len(str(n))`.
2. `s = sum(int(d) ** k for d in str(n))`.
3. Return `s == n`.

Without strings: count digits by repeated division, then sum `d^k` with a second loop.

Do not use a fixed exponent of 3; the power is the digit count. Floating-point `pow` can round; use integer powers.

Time: O(digits)  
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

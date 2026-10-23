You get an integer n. One operation splits a number x into two positive integers a and b with a + b = x, and costs a · b. Return the minimum total cost to break n into n ones. This version allows a much larger n than Minimum Cost to Split into Ones. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count pairs

1. Return n · (n − 1) / 2 in 64-bit integers.

Constructed checks (made-up values, run in code): n = 5 → 10; n = 7 → 21. A DP over every split matched n(n − 1) / 2 for all n ≤ 60. Edge check: n = 5 · 10^7 → 1,249,999,975,000,000.

Multiplying in 32-bit integers: the edge check → −864,376,896.

Time: O(1)  
Space: O(1)

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

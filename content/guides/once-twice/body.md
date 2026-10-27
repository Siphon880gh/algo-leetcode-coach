Every value in an array appears exactly three times, except one value that appears once and another that appears twice. Return [the value that appears once, the value that appears twice]. The intended solution uses linear time and constant extra space. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two passes of bit counting

1. c[b] = (number of elements with bit b) mod 3, for each bit.
2. Pick a bit d with c[d] ≠ 0 (the two values differ, so one exists).
3. Split the array by bit d. In each half, rebuild a value from the bits whose count mod 3 is non-zero.
4. If c[d] = 1, the half with bit d holds the once-value and the other half the twice-value; if c[d] = 2, the other way round.

Constructed checks (run in code): [3, 7, 7, 5, 5, 5] → [3, 7]; [1, 2, 2, 4, 4, 4] → [1, 2]. Checked against a counter on 1,000 random arrays. This assumes non-negative values that fit in 31 bits; if extra memory is allowed, a hash-map count is simpler.

Reading the once-value as the bits whose count mod 3 is 1: [3, 7, 7, 5, 5, 5] → 0 instead of 3.

Time: O(n · B), with B bits  
Space: O(B)

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

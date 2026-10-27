Design a tracker over a queue of numbers: add a number, remove the earliest added number, and report the floored mean, the median, and the mode (the smallest value on ties). Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Three structures

This assumes the median of an even count is the larger middle value; check the official statement.

1. add(x): queue, sum += x, sorted list insert, move x from (−c, x) to (−c − 1, x).
2. remove: pop the queue front and undo the same three updates.
3. mean = ⌊sum / size⌋; median = sorted[size / 2]; mode = first entry of the frequency set.

Constructed check (run in code): add 4, 1, 7, 3 → mean 3, median 4, mode 1; remove → mean 3, median 3, mode 1. Checked against recomputing on 300 random sequences.

Taking the lower middle value: the first median → 3 instead of 4.

Time: O(log n) per operation  
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

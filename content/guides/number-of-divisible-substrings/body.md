Each lowercase letter has a fixed small value, given by a mapping in the official statement. A substring is divisible when the sum of its letters’ values is divisible by its length. Count the divisible substrings. Limits are in the official statement. For instance, letters with values [1, 2, 3] give 4 divisible substrings: the three single letters and the whole string. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Nine prefix-sum passes

This assumes letter values are whole numbers from 1 to 9, so the average of a divisible substring is one of them.

1. For d = 1 … 9: walk the string with `s += value − d`; add how many earlier prefixes had the same s; record s (starting from s = 0 once).
2. Return the total.

Constructed checks (run in code): the example above; 1,500 random value arrays match testing every substring.

Each divisible substring is counted once, for its own average. Testing every substring is O(n²), which may also be fast enough depending on the official limits.

Time: O(9n)  
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

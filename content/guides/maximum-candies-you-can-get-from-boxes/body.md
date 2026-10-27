## Open what you can

1. `have = initialBoxes`, `keys = {}`, `opened = {}`.
2. While some box in `have` is unopened and (`status = 1` or in `keys`): open it, add `candies`, add its `keys`, add its `containedBoxes` to `have`.
3. Return the candy total.

A queue works too: when you gain a key for a box you already hold, enqueue it.

First example → 16. Second → 6.

Do not open a box just because you have its key; you must also hold the box. Do not open a box twice.

Time: O(boxes + keys + contained)  
Space: O(boxes)

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

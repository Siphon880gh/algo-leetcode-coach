## Two conversions

1. `valueOf()`: return the sum of nums (0 for an empty array).
2. `toString()`: return `[` + nums joined by commas + `]`.

Examples → 10, [23,98,42,70], 0. Checked in Node.

Adding two objects converts each to a primitive with valueOf first, so obj1 + obj2 becomes a numeric sum; String(obj) prefers toString.

Time: O(n) per conversion  
Space: O(n) for toString

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

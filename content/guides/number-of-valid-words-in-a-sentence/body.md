## Three rules per token

1. Tokens = `sentence.split()` (handles repeated spaces).
2. Valid iff it matches `^([a-z]+(-[a-z]+)?)?[!.,]?$` and is non-empty.

Examples → 3, 0, 5.

The optional group allows a lone punctuation token like `"!"`. `-[a-z]+` forces letters after the hyphen and the leading `[a-z]+` forces letters before it, so `"-ab"` and `"ab-"` fail. Without regex, scan once and track hyphen and punctuation positions.

Time: O(n)  
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

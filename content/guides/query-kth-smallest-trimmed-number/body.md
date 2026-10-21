## Sort per query

1. For each `[k, trim]`: sort indices `i` by `(nums[i][len − trim:], i)`.
2. Answer the index at position `k − 1`.

Examples → [2,2,1,0], [3,0].

Trimmed strings all have length trim, so text order equals numeric order, leading zeros included; converting to integers can overflow, since strings have up to 100 digits. Ties go to the lower index, which the second key handles. Sorting per distinct trim and reusing it, or a radix sort by digits, avoids repeated work.

Time: O(q · n log n · len)  
Space: O(n)

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

## Signatures bottom-up

`sig(node)`: null → `"#"`; otherwise `f"{sig(left)},{sig(right)},{node.val}"`. Count each signature; when its count becomes exactly 2, append `node` to the answer.

Identical subtrees, meaning the same shape and values, have identical signatures, because the null markers pin the shape. Reporting at count 2 adds each duplicate group once.

Long strings make this O(n²) in the worst case. To get O(n), map each `(left_id, val, right_id)` triple to a small integer id and count the ids instead.

Do not leave out the null markers; `[1,2]` and `[1,null,2]` would look the same. Do not report every repeat; only the second sighting goes into the answer.

Time: O(n²) with strings, O(n) with triple ids  
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

## Slide a time window

`ping(t)`:

1. Append `t`.
2. While `queue.front < t − 3000`, pop the front.
3. Return `len(queue)`.

Because times strictly increase, old calls only ever leave from the front, and each call is added and removed once.

Do not scan all calls each time; that is O(n) per ping. Do not use `≤` in the pop test; a call exactly at `t − 3000` still counts.

Time: O(1) amortized per ping  
Space: O(w), w = calls in the window (at most 3001)

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

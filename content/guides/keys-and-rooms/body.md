## Reachability

`seen = {0}`, `stack = [0]`. While the stack is non-empty: pop a room and push each key in it that opens an unseen room, marking it seen.

Return `len(seen) == n`.

Keys can be used any number of times, and holding a key is the same as being able to enter that room, so the question is plain reachability from room 0.

Do not BFS from every room; only room 0 is unlocked at the start. Do not stop at the first room with no keys; other branches may continue.

Time: O(n + total keys)  
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

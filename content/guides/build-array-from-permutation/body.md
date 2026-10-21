## Direct

`ans = [nums[nums[i]] for i in range(n)]`.

`[0,2,1,5,3,4]` → `[0,1,2,4,5,3]`. `[5,0,1,2,3,4]` → `[4,5,0,1,2,3]`.

Follow-up (in place): `nums[i] += n · (nums[nums[i]] % n)` for all `i`, then `nums[i] //= n`. The `% n` reads the original value even after a cell was updated.

Time: O(n)  
Space: O(n), or O(1) in place

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

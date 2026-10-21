## Rule options out

`inc = dec = true`. For each `i ≥ 1`:

- `nums[i] > nums[i − 1]` → `dec = false`.
- `nums[i] < nums[i − 1]` → `inc = false`.

Return `inc or dec`.

Equal neighbors keep both options alive, so constant runs are fine.

You can stop early once both flags are false.

Do not decide the direction from the first two elements; they may be equal. Do not sort and compare; that is O(n log n) for an O(n) question.

Time: O(n)  
Space: O(1)

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

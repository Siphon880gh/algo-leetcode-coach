## Resolve waits when a warmer day comes

`ans = [0] * n`, stack empty. For each day `i`:

- While the stack is non-empty and `T[stack top] < T[i]`: pop `j`, set `ans[j] = i − j`.
- Push `i`.

Days left on the stack never see a warmer day and keep 0.

Each index is pushed and popped at most once, so the loop is linear even though it has a nested while.

A right-to-left alternative jumps: for day `i`, start at `j = i + 1` and follow `j += ans[j]` until `T[j] > T[i]` or `ans[j] == 0`.

Do not pop on equal temperatures; the wait is for a strictly warmer day. Do not scan forward from each day; that is O(n²).

Time: O(n)  
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

## Charge time to the top of the stack

Keep `ans = [0] * n`, a stack, and `prev`, the first time unit not yet charged.

For each log `id:type:t`:

- **start:** if the stack is not empty, the function on top ran from `prev` to `t − 1`: `ans[top] += t − prev`. Push `id` and set `prev = t`.
- **end:** the top (which is `id`) ran from `prev` to `t` inclusive: `ans[id] += t − prev + 1`. Pop and set `prev = t + 1`.

The `+ 1` on end events, and `prev = t + 1` afterward, come from the end timestamp being the last unit of time the function owns.

Do not subtract child time afterward from a total duration; charging each slice to the current top as you go is simpler and handles recursion. Do not treat end as exclusive; `"0:start:0"`, `"0:end:0"` is 1 unit.

Time: O(number of logs)  
Space: O(depth of the call stack)

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

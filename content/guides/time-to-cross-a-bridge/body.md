## Event simulation

1. `waitL` holds all workers, least efficient first: larger `left + right`, then larger index. `waitR`, `busyL`, `busyR` start empty; `t = 0`.
2. Move every busy worker whose finish time is `≤ t` to the waiting heap on their side.
3. If `waitR` is non-empty: pop, `t += left`; if no boxes remain to send and nobody else is on the right, return `t`; else push to `busyL` finishing at `t + put`.
4. Else if boxes remain and `waitL` is non-empty: pop, `t += right`, one fewer box to send, push to `busyR` finishing at `t + pick`.
5. Else jump `t` to the earliest busy finish time and repeat.

Examples → 6, 37.

The answer is when the last box reaches the left bank, not when it is put down, which is why Example 1 → 6 rather than 7. Each box causes a constant number of heap operations.

Time: O((n + k) log k)  
Space: O(k)

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

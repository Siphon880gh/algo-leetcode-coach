Write customInterval, which calls a function repeatedly with gaps that grow according to a delay and a period, and returns an id; and customClearInterval, which stops those calls for that id. The exact timing rule and names are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Chained timeouts

1. `id` = a fresh number; `k = 0`.
2. `next()`: `handles[id] = setTimeout(() => { fn(); k += 1; next(); }, gap(k))`, with gap from the statement’s rule.
3. customClearInterval(id): `clearTimeout(handles[id])`.

Constructed check (run in Node, with gaps of delay + k · period, delay 20 ms and period 10 ms): calls at about 20, 50 and 90 ms, and none after clearing at 130 ms.

setInterval cannot change its gap. Keep only the latest handle: the earlier timeouts have already fired.

Time: O(1) per call  
Space: O(number of active intervals)

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

## Per-digit queues

1. `pos[d]` = queue of indices of digit d in s.
2. For each `d` in t: if `pos[d]` is empty, false. Let `i = pos[d][0]`; if any `e < d` has `pos[e][0] < i`, false. Pop.
3. Return true.

`"84532"` → `"34852"` true. `"34521"` → `"23415"` true. `"12345"` → `"12435"` false.

Do not simulate sorts. Adjacent swaps of an inversion (larger before smaller) are the only moves, so a digit can never pass a smaller one.

Time: O(10n)  
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

## Smallest reachable digit

1. Queues `pos[d]` of original indices per digit.
2. Repeat n times: for `d` 0..9 with `pos[d]` non-empty, let `i = pos[d][0]`; cost = `i − (removed indices before i)` (BIT query). If cost ≤ k: append `d`, `k −= cost`, mark `i` removed, pop; break.

`"4321"`, 4 → `"1342"`. `"100"`, 1 → `"010"`. `"36789"`, 1000 → `"36789"`.

Do not simulate the swaps (O(n²) with n up to 3 · 10^4 and k up to 10^9). Leading zeros are allowed in the output.

Time: O(n · 10 · log n)  
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

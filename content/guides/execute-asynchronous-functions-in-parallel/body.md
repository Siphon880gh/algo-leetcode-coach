## Manual Promise.all

1. Return a new Promise; `out = new Array(n)`, `left = n`.
2. For each function i: call it; on success set `out[i]` and resolve with out when `--left` reaches 0; on failure reject.

Examples → {t: 200, resolved: [5]}, {t: 100, rejected: Error}, {t: 150, resolved: [4, 10, 16]}. Checked in Node with real timers.

Store by index, not by push: results arrive in completion order, so values resolving at 60 ms and 20 ms → [2, 1] instead of [1, 2]. A promise settles only once, so later rejections after the first are ignored.

Time: O(n) besides the functions  
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

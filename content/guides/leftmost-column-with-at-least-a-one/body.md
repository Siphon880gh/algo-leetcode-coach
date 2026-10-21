A binary matrix has each row sorted (all 0s, then all 1s) and can only be read through an interface that returns its dimensions and single cells, with a limited number of calls. Return the leftmost column index containing a 1, or −1 if there is none. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## At most m + n reads

1. `r = 0`, `c = cols − 1`, `ans = −1`.
2. While `r < rows` and `c ≥ 0`: if `get(r, c) == 1`, `ans = c`, `c −= 1`; else `r += 1`.
3. Return `ans`.

For instance, rows `[0,0,1]` and `[0,1,1]` → 1.

Binary searching each row also works in O(m log n) reads. Do not read every cell; the call budget is limited.

Time: O(m + n) reads  
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

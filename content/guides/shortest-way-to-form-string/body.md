Given strings `source` and `target`, return the fewest subsequences of `source` whose concatenation equals `target`, or −1 if that is impossible. `source = "abc"`, `target = "abcbc"` → 2 (`"abc"` + `"bc"`). `source = "abc"`, `target = "acdbc"` → −1. `source = "xyz"`, `target = "xzyxz"` → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Take as much as each pass allows

`j = 0` (position in `target`), `count = 0`. While `j < len(target)`:

1. `start = j`. For each character of `source`, if it equals `target[j]`, advance `j` (stop at the end).
2. If `j == start`, return −1 (`target[j]` does not occur in `source`).
3. `count += 1`.

Return `count`.

A next-occurrence table `nxt[i][c]` (first position ≥ `i` of letter `c` in `source`) lets each target letter jump directly, giving O(26 · |source| + |target|).

Do not split target at fixed lengths; a greedy longest match per pass is optimal. Do not loop forever on a letter that is missing from source; step 2 catches it.

Time: O(|source| · |target|), or O(26 · |source| + |target|) with the table  
Space: O(1), or O(26 · |source|)

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

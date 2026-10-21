## Extend, skip, or start

For each `x`:
- `0`: `z = 2z + 1`
- `1`: `o = 2o + z`
- `2`: `t = 2t + o`

Return `t` mod 1e9+7.

`[0,1,2,2]` → 3. `[2,2,0,0]` → 0. `[0,1,2,0,1,2]` → 7. Checked against enumerating all subsequences on random arrays.

The doubling counts "take it or not" for sequences already in that stage; the added term promotes sequences from the previous stage. Subsequences differ by index sets, so equal-looking ones count separately.

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

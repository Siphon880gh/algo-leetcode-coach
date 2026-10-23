## Tiny example

Linked-list toolkit on `1→2→3→4`.

1. **Dummy head** before `1` simplifies empty/head edge deletes
2. **Fast/slow**: fast moves 2, slow 1 — mid of even/odd lists
3. **Rewire**: save `nxt=cur.next` before changing pointers

Most list bugs are lost `next` references.


## How

1. Draw pointers before coding
2. Use dummy when head may change
3. Save `next` before rewires


## Trap

Updating `cur.next` before saving the old next — losing the rest of the list.

**Fix:** Temp variable first; then rewire.

**Time:** O(n) typical walks · **Space:** O(1) pointer tricks

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

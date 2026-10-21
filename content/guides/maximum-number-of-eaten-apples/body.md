## Earliest expiry first

1. Day `i`: if `apples[i] > 0`, push `(i + days[i], apples[i])`.
2. Pop batches with expiry `≤ i` or count 0.
3. If any remain, eat one from the top; `eaten += 1`.
4. Keep going past `n` until the heap is empty.

`[1,2,3,5,2]`, `[3,2,1,4,2]` → 7. `[3,0,0,0,0,2]`, `[3,0,0,0,0,2]` → 5.

After day n you can jump ahead: eat `min(count, expiry − day)` from the top batch at once. Do not stop at day n.

Time: O(n log n)  
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

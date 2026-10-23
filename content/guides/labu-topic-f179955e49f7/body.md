## Tiny example

Array pattern menu on `a=[1,2,3,4]`:

| Pattern | Idea |
|---------|------|
| Two pointers | opposite ends or slow/fast |
| Sliding window | grow/shrink a segment with a constraint |
| Prefix sums | range sums in O(1) after O(n) |
| In-place swap | rearrange with O(1) extra |

Example window: longest subarray with sum ≤ 3 on `[1,2,3,4]` grows/shrinks `L,R`.


## How

1. Match the prompt to a row
2. State the invariant (window sum, pointers…)
3. Advance pointers monotonically when possible


## Trap

Resetting both pointers from scratch every time — accidentally O(n²).

**Fix:** Move pointers only forward when the invariant allows.

**Time:** often O(n) when pointers only advance

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

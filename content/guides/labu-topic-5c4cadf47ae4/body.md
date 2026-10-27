## Tiny example

Array basics, using `[4, 5, 6]`:

- Reading index `1` gives `5` in O(1) time.
- Inserting at index `1` shifts `5` and `6` one place to the right, which takes O(n) time.
- A prefix array, `pre[i] = pre[i-1] + a[i]`, makes later range sums quick.

These ideas are the foundation for two pointers, sliding windows and prefix sums.

## How

1. Use index arithmetic for reads.
2. Budget for shifting elements when you insert.
3. Build prefix sums when range queries appear.

## Trap

Doing many inserts in the middle of a huge array when a deque or a linked list would handle them cheaply.

**Fix:** Choose the structure that matches how you update the data.

**Time:** reads are O(1); an insert in the middle is O(n); building prefix sums is O(n)

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

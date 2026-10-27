## Tiny example

Greedy basics, using interval scheduling.

The intervals, written as (start, end), are `(1,3)`, `(2,4)` and `(3,5)`. Choose as many as possible without overlaps.

Greedy rule: among the remaining compatible intervals, always take the one that **ends earliest**. This picks `(1,3)`, then `(3,5)`.

A greedy rule needs a proof, such as an exchange argument. Without one, a counterexample may exist.

## How

1. Propose a rule for choosing.
2. Sort, and commit to each choice.
3. Prove the rule, or look for a counterexample.

## Trap

Trusting a greedy rule because it passed one sample.

**Fix:** Require a proof sketch, or use a pattern already known to be safe.

**Time:** often O(n log n), from sorting

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.

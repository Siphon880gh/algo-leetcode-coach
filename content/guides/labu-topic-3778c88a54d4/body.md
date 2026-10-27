## Tiny example

A puzzle: a family has two children, and at least one is a boy. Assume each child is a boy or a girl with equal chance, and ignore special cases like identical twins.

Before using the clue, there are four equally likely outcomes: BB, BG, GB and GG.

The clue "at least one boy" rules out GG, which leaves BB, BG and GB.

So the chance that both are boys is `1/3`, not `1/2`.

The lesson: **list the equally likely outcomes**. Intuition about chance is often wrong.

## How

1. Write out all the equally likely outcomes.
2. Apply the condition by crossing out the outcomes it rules out.
3. Count what is left.

## Trap

Replacing the list of outcomes with a gut feeling of "50-50".

**Fix:** Always write a finite list of equally likely outcomes first, or a clear probability model.

**Skill:** conditioning carefully, not just memorizing formulas

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

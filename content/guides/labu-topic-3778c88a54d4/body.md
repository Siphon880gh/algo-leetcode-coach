## Tiny example

Probability puzzle: two-child family, at least one boy. Boy/girl equally likely, ignore twins quirks.

Sample space of two children: `{BB,BG,GB,GG}` equally likely.

Condition on “at least one boy” → drop `GG` → `{BB,BG,GB}`.

Probability both boys = `1/3` (not `1/2`).

Lesson: **enumerate equally likely outcomes**; intuition often lies.


## How

1. Write the sample space
2. Apply the condition by deleting outcomes
3. Count survivors


## Trap

Replacing enumeration with a gut “50-50” call.

**Fix:** Force a finite equally likely list (or clear density) first.

**Skill:** careful conditioning, not formula memorization alone

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
